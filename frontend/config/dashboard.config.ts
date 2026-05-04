import {
  Building2,
  ClipboardCheck,
  FileCheck2,
  FileText,
  Landmark,
  LayoutDashboard,
  ShieldCheck,
  UserCheck,
  Users,
} from "lucide-react";
import type { LucideIcon } from "lucide-react";

export type AppRoleKey =
  | "super-admin"
  | "subcity-admin"
  | "woreda-admin"
  | "city-front-officer"
  | "city-back-officer"
  | "subcity-front-officer"
  | "subcity-back-officer"
  | "woreda-front-officer"
  | "woreda-back-officer"
  | "customer";

export type DashboardDefinition = {
  key: AppRoleKey;
  roleName: string;
  title: string;
  subtitle: string;
  route: string;
  icon: LucideIcon;
  cards: { label: string; value: string; description: string }[];
};

export const roleHome: Record<AppRoleKey, string> = {
  "super-admin": "/dashboard/super-admin",
  "subcity-admin": "/dashboard/subcity-admin",
  "woreda-admin": "/dashboard/woreda-admin",
  "city-front-officer": "/dashboard/city-front-officer",
  "city-back-officer": "/dashboard/city-back-officer",
  "subcity-front-officer": "/dashboard/subcity-front-officer",
  "subcity-back-officer": "/dashboard/subcity-back-officer",
  "woreda-front-officer": "/dashboard/woreda-front-officer",
  "woreda-back-officer": "/dashboard/woreda-back-officer",
  customer: "/dashboard/customer",
};

const adminCards = [
  { label: "Users", value: "Manage", description: "Create, update, activate, and deactivate users." },
  { label: "Roles", value: "RBAC", description: "Assign roles and permissions by responsibility." },
  { label: "Locations", value: "City", description: "Manage city, subcity, and woreda access." },
  { label: "Audit", value: "Trace", description: "Review sensitive actions and system activity." },
];

const officerCards = [
  { label: "Assigned Requests", value: "0", description: "Service requests assigned to your desk." },
  { label: "Pending Tasks", value: "0", description: "Applications waiting for action." },
  { label: "Completed", value: "0", description: "Processed applications." },
  { label: "Returned", value: "0", description: "Applications returned for correction." },
];

export const dashboardConfig: Record<AppRoleKey, DashboardDefinition> = {
  "super-admin": {
    key: "super-admin",
    roleName: "Super Admin",
    title: "City Super Admin Dashboard",
    subtitle: "City-wide user, role, permission, location, report, and audit control.",
    route: roleHome["super-admin"],
    icon: ShieldCheck,
    cards: adminCards,
  },
  "subcity-admin": {
    key: "subcity-admin",
    roleName: "Subcity Admin",
    title: "Subcity Admin Dashboard",
    subtitle: "Manage users and operations inside the assigned subcity.",
    route: roleHome["subcity-admin"],
    icon: Building2,
    cards: adminCards,
  },
  "woreda-admin": {
    key: "woreda-admin",
    roleName: "Woreda Admin",
    title: "Woreda Admin Dashboard",
    subtitle: "Manage officers, customers, and service activity in the assigned woreda.",
    route: roleHome["woreda-admin"],
    icon: Landmark,
    cards: adminCards,
  },
  "city-front-officer": {
    key: "city-front-officer",
    roleName: "City Front Officer",
    title: "City Front Officer Dashboard",
    subtitle: "Register customers, receive applications, verify documents, and forward requests.",
    route: roleHome["city-front-officer"],
    icon: ClipboardCheck,
    cards: officerCards,
  },
  "city-back-officer": {
    key: "city-back-officer",
    roleName: "City Back Officer",
    title: "City Back Officer Dashboard",
    subtitle: "Review applications, process requests, approve, reject, or return applications.",
    route: roleHome["city-back-officer"],
    icon: FileCheck2,
    cards: officerCards,
  },
  "subcity-front-officer": {
    key: "subcity-front-officer",
    roleName: "Subcity Front Officer",
    title: "Subcity Front Officer Dashboard",
    subtitle: "Receive and verify subcity-level service applications.",
    route: roleHome["subcity-front-officer"],
    icon: ClipboardCheck,
    cards: officerCards,
  },
  "subcity-back-officer": {
    key: "subcity-back-officer",
    roleName: "Subcity Back Officer",
    title: "Subcity Back Officer Dashboard",
    subtitle: "Process and complete assigned subcity service requests.",
    route: roleHome["subcity-back-officer"],
    icon: FileCheck2,
    cards: officerCards,
  },
  "woreda-front-officer": {
    key: "woreda-front-officer",
    roleName: "Woreda Front Officer",
    title: "Woreda Front Officer Dashboard",
    subtitle: "Register walk-in customers and receive woreda service applications.",
    route: roleHome["woreda-front-officer"],
    icon: ClipboardCheck,
    cards: officerCards,
  },
  "woreda-back-officer": {
    key: "woreda-back-officer",
    roleName: "Woreda Back Officer",
    title: "Woreda Back Officer Dashboard",
    subtitle: "Review, approve, reject, return, or complete woreda service workflow tasks.",
    route: roleHome["woreda-back-officer"],
    icon: FileCheck2,
    cards: officerCards,
  },
  customer: {
    key: "customer",
    roleName: "Customer",
    title: "Customer Dashboard",
    subtitle: "Submit applications, track status, receive notifications, and download documents.",
    route: roleHome.customer,
    icon: UserCheck,
    cards: [
      { label: "My Applications", value: "0", description: "Submitted service applications." },
      { label: "Pending", value: "0", description: "Applications waiting for processing." },
      { label: "Approved", value: "0", description: "Approved services and documents." },
      { label: "Returned", value: "0", description: "Applications needing correction." },
    ],
  },
};

export const dashboardList = Object.values(dashboardConfig);

export function normalizeRole(role?: string | null): AppRoleKey {
  const value = String(role ?? "")
    .toLowerCase()
    .replace(/&/g, "and")
    .replace(/_/g, " ")
    .replace(/-/g, " ")
    .trim();

  if (value.includes("super") || value.includes("general admin") || value.includes("city admin")) return "super-admin";
  if (value.includes("subcity") && value.includes("admin")) return "subcity-admin";
  if (value.includes("woreda") && value.includes("admin")) return "woreda-admin";
  if (value.includes("city") && value.includes("front")) return "city-front-officer";
  if (value.includes("city") && value.includes("back")) return "city-back-officer";
  if (value.includes("subcity") && value.includes("front")) return "subcity-front-officer";
  if (value.includes("subcity") && value.includes("back")) return "subcity-back-officer";
  if (value.includes("woreda") && value.includes("front")) return "woreda-front-officer";
  if (value.includes("woreda") && value.includes("back")) return "woreda-back-officer";
  if (value.includes("customer")) return "customer";
  if (value.includes("front")) return "woreda-front-officer";
  if (value.includes("back")) return "woreda-back-officer";
  return "super-admin";
}

export function getDashboardForRole(role?: string | null) {
  return dashboardConfig[normalizeRole(role)];
}
